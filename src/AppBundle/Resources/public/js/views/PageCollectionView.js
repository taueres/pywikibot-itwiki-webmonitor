var PageCollectionView;
$(function () {
    PageCollectionView = Backbone.View.extend({
        template: _.template($('#underscore-paginator-template').html()),
        initialize: function () {
            this.collection.on('reset', this.render, this);
        },
        render: function () {
            this.$el.html(this.template());
            this.collection.forEach(this.addOne, this);
            return this;
        },
        addOne: function (pageModel) {
            var pageView = new PageView({model: pageModel});
            this.$el.find('li.sep').before(pageView.render().el);
        },
        events: {
            'click #reload-button-paginator': 'refreshPage'
        },
        refreshPage: function () {
            fetchLogCollection(logCollection, this.collection, this.collection.currentPage);
        }
    });
});
