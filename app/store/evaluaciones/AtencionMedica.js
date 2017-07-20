Ext.define('sisscsj.store.evaluaciones.AtencionMedica', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.atencionmedica',
    requires: [
        'sisscsj.model.evaluaciones.AtencionMedica'
    ],
    restPath: 'EvalAtencionMedica',
    storeId: 'AtencionMedica',
    model: 'sisscsj.model.evaluaciones.AtencionMedica'
});