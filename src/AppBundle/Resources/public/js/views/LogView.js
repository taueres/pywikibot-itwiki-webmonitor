var LogView;
$(function () {
    LogView = Backbone.View.extend({
        tagName: 'tr',
        template: _.template($('#underscore-log-template').html()),
        initialize: function(){
            this.logTextView = null;
            this.render();
        },
        render: function(){
            this.$el.html(this.template(this.model.toJSON()));
            if (null !== this.logTextView) {
                this.$el.find('.cell-log-text').html('');
                this.$el.find('.cell-log-text').append(this.logTextView.el);
            }
            return this;
        },
        events: {
            'click': 'toggleLogText'
        },
        toggleLogText: function () {
            if (null === this.logTextView) {
                var logTextModel = new LogTextModel();
                this.logTextView = new LogTextView({model: logTextModel});
                logTextModel.fetchModelByLogId(this.model.get('id'));
                this.render();
            } else {
                this.$el.find('.cell-log-text').html('Click to load');
                this.logTextView = null;
            }
        }
    });
});