<?php
namespace App\Classes;

use DB;
use Carbon\Carbon;
use App\Models\Visitor;
use App\Models\VisitorPerDay;
use App\Models\VisitorDetail;

class AuditVisitor {


    /**
     * Request Instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Initialize request instance and run method ro recourd
     */
    public function __construct()
    {
        $this->request = app('request');
        $this->doRecord();
    }

    /**
     * Run proses method toVisitor, toVisitorPerDay, toVisitorDetail
     *
     * @return void
     */
    public function doRecord()
    {
        DB::beginTransaction();
        try {
            $this->toVisitor();

            $this->toVisitorPerDay();

            $this->toVisitorDetail();
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            \Log::error($e);
        }
    }

    /**
     * Store visitor to table visitors
     *
     * @return void
     */
    public function toVisitor()
    {
        $visitor = Visitor::firstOrNew([
            'date' => Carbon::now()->toDateString(),
        ]);
        $visitor->total += 1;
        $visitor->save();
    }

    /**
     * Store visitor to table visitor_per_days
     *
     * @return void
     */
    public function toVisitorPerDay()
    {
        $visitorPerDay = VisitorPerDay::firstOrNew([
            'date' => Carbon::now()->toDateString(),
            'page' => $this->getUrl(),
        ]);
        $visitorPerDay->total += 1;
        $visitorPerDay->save();
    }

    /**
     * Store visitor to table visitor_details
     *
     * @return void
     */
    public function toVisitorDetail()
    {   
        VisitorDetail::create([
            'date' => Carbon::now()->toDateString(),
            'page' => $this->getUrl(),
            'ip_address' => $this->request->ip(),
            'browser' => (new \Jenssegers\Agent\Agent())->browser()
        ]);
    }

    /**
     * Get current url via request instance
     *
     * @return void
     */
    private function getUrl()
    {
        return $this->request->url();
    }
    
}