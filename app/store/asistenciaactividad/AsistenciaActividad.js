Ext.define('sisscsj.store.asistenciaactividad.AsistenciaActividad', {
    extend: 'sisscsj.store.Base',
    alias: 'store.asistenciaactividad.asistenciaactividad',
    requires: [
        'sisscsj.model.asistenciaactividad.AsistenciaActividad'
    ],
    restPath: 'Asistencia',
    storeId: 'AsistenciaActividad',
    model: 'sisscsj.model.asistenciaactividad.AsistenciaActividad'
});