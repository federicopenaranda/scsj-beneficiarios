Ext.define('sisscsj.store.evaluaciones.Odontologia', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.odontologia',
    requires: [
        'sisscsj.model.evaluaciones.Odontologia'
    ],
    restPath: 'EvalOdontologia',
    storeId: 'Odontologia',
    model: 'sisscsj.model.evaluaciones.Odontologia'
});