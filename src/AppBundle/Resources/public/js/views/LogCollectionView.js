var LogCollectionView;
$(function () {
    LogCollectionView = Backbone.View.extend({
        initialize: function () {
            this.templateInfo = _.template($('#underscore-total-result-template').html());
            this.collection.on('reset', this.render, this);
        },
        render: function () {
            this.$el.html('');
            this.collection.forEach(this.addOne, this);
            this.renderInfo();
            return this;
        },
        addOne: function (logModel) {
            var logView = new LogView({model: logModel});
            this.$el.append(logView.render().el);
        },
        renderInfo: function () {
            $(this.elInfo).html(
                this.templateInfo({
                    page: this.collection.currentPage,
                    length: this.collection.length,
                    total: this.collection.totalSize
                })
            );
        }
    });
});
