Ext.define('sisscsj.store.actividad.ActividadBeneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.actividad.actividadbeneficiario',
    requires: [
        'sisscsj.model.actividad.ActividadBeneficiario'
    ],
    restPath: 'actividad/actividadBeneficiario',
    //restPath: 'usuario/idbeneficiario',
    storeId: 'ActividadBeneficiario',
    model: 'sisscsj.model.actividad.ActividadBeneficiario'
});