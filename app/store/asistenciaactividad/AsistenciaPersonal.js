Ext.define('sisscsj.store.asistenciaactividad.AsistenciaPersonal', {
    extend: 'sisscsj.store.Base',
    alias: 'store.asistenciaactividad.asistenciapersonal',
    requires: [
        'sisscsj.model.asistenciaactividad.AsistenciaPersonal'
    ],
    restPath: 'PersonalAsistencia',
    storeId: 'AsistenciaPersonal',
    model: 'sisscsj.model.asistenciaactividad.AsistenciaPersonal'
});