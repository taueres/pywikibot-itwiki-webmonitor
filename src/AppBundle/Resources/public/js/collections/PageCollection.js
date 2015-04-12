var PageCollection;
$(function () {
    PageCollection = Backbone.Collection.extend({
        model: PageModel,
        populateWithData: function(numOfPages, currentPage) {
            var data = [];
            for (var i = 1; i <= numOfPages; i++) {
                data.push({
                    id: i,
                    page: i,
                    isCurrent: i == currentPage
                });
            }
            this.currentPage = currentPage;
            this.reset(data);
        }
    });
});
