var LogTextView;
$(function () {
    LogTextView = Backbone.View.extend({
        tagName: 'pre',
        initialize: function () {
            this.model.on('change', this.render, this);
        },
        render: function () {
            this.$el.html(this.model.get('text'));
            return this;
        }
    });
});