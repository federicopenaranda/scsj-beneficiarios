Ext.define('sisscsj.store.asistenciaactividad.AsistenciaBeneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.asistenciaactividad.asistenciabeneficiario',
    requires: [
        'sisscsj.model.asistenciaactividad.AsistenciaBeneficiario'
    ],
    restPath: 'BeneficiarioAsistencia',
    storeId: 'AsistenciaBeneficiario',
    model: 'sisscsj.model.asistenciaactividad.AsistenciaBeneficiario'
});