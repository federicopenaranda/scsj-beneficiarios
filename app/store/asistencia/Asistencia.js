Ext.define('sisscsj.store.asistencia.Asistencia', {
    extend: 'sisscsj.store.Base',
    alias: 'store.asistencia.asistencia',
    requires: [
        'sisscsj.model.asistencia.Asistencia'
    ],
    restPath: 'Asistencia',
    storeId: 'Asistencia',
    model: 'sisscsj.model.asistencia.Asistencia'
});