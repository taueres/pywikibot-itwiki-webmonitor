var LogCollection, fetchLogCollection;
$(function () {
    LogCollection = Backbone.Collection.extend({
        model: LogModel
    });

    fetchLogCollection = function (logCollection, pageCollection, page) {
        page = page || 1;
        $.ajax({
            url: Routing.generate('ws_log_list', {"page": page}),
            success: function (data) {
                logCollection.currentPage = page;
                logCollection.totalSize = data.size;
                logCollection.reset(data.items);
                pageCollection.populateWithData(data.pages, page);
            }
        });
    };
});
