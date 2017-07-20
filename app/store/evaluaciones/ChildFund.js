Ext.define('sisscsj.store.evaluaciones.ChildFund', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.childfund',
    requires: [
        'sisscsj.model.evaluaciones.ChildFund'
    ],
    restPath: 'EvalEduChildfund',
    storeId: 'ChildFund',
    model: 'sisscsj.model.evaluaciones.ChildFund'
});