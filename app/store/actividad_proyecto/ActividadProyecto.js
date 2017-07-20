Ext.define('sisscsj.store.actividad_proyecto.ActividadProyecto', {
    extend: 'sisscsj.store.Base',
    alias: 'store.actividad_proyecto.actividadproyecto',
    requires: [
        'sisscsj.model.actividad_proyecto.ActividadProyecto'
    ],
    restPath: 'ActividadProyecto',
    storeId: 'ActividadProyecto',
    model: 'sisscsj.model.actividad_proyecto.ActividadProyecto'
});