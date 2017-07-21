_DatatableFactory = (function($, selector, url, columns) {
    var table;

    build = function(selector, url, columns) {
        table = selector.DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: columns,
            initComplete: function() {
                dataTablesIndex();
            }
        });
    };

    dataTablesIndex = function(noIndex) {
        table.on('order.dt search.dt', function() {
            var pageIndex = table.page() * table.page.len();
            table.column(noIndex, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = pageIndex + i + 1;
            });
        }).draw();
    };

    return {
        build: build,
        dataTablesIndex: dataTablesIndex
    }
})(jQuery);