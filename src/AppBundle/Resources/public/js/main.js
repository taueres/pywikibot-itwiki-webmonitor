var logCollection, logCollectionView, pageCollection, pageCollectionView;
$(function () {
    logCollection = new LogCollection();
    logCollectionView = new LogCollectionView({
        collection: logCollection,
        el: document.getElementById('log-table-list')
    });
    logCollectionView.elInfo = document.getElementById('table-result-info');

    pageCollection = new PageCollection();
    pageCollectionView = new PageCollectionView({
        collection: pageCollection,
        el: document.getElementById('paginator-controls')
    });

    fetchLogCollection(logCollection, pageCollection, 1);
});