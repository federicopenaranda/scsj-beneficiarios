Ext.define('sisscsj.store.actividad_proyecto.ActividadTipoParticipante', {
    extend: 'sisscsj.store.Base',
    alias: 'store.actividad_proyecto.actividadtipoparticipante',
    requires: [
        'sisscsj.model.actividad_proyecto.ActividadTipoParticipante'
    ],
    restPath: 'ActividadTipoParticipante',
    storeId: 'ActividadTipoParticipante',
    model: 'sisscsj.model.actividad_proyecto.ActividadTipoParticipante'
});