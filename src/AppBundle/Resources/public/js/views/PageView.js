var PageView;
$(function () {
    PageView = Backbone.View.extend({
        tagName: 'li',
        template: _.template($('#underscore-page-template').html()),
        initialize: function () {
            this.model.on('change', this.render, this);
        },
        render: function(){
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },
        events: {
            'click': 'changePage'
        },
        changePage: function (event) {
            event.preventDefault();
            if (this.model.get('isCurrent')) {
                // Current page, no action needed
                return;
            }
            fetchLogCollection(logCollection, pageCollection, this.model.get('page'));
        }
    });
});