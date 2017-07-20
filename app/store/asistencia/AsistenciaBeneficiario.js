Ext.define('sisscsj.store.asistencia.AsistenciaBeneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.asistencia.asistenciabeneficiario',
    requires: [
        'sisscsj.model.asistencia.AsistenciaBeneficiario'
    ],
    //restPath: 'BeneficiarioAsistencia',
    restPath: 'Usuario/beneficiariosUsuario',
    storeId: 'AsistenciaGeneralBeneficiario',
    model: 'sisscsj.model.asistencia.AsistenciaBeneficiario'
});