Ext.define('sisscsj.model.actividad_proyecto.ActividadProyecto', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_actividad_proyecto',
    fields: [
        // id field
        {
            name: 'id_actividad_proyecto',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_gestion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_lugar_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'titulo_actividad_proyecto',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_inicio_actividad_proyecto',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d'
        },
        {
            name: 'fecha_fin_actividad_proyecto',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d'
        },
        {
            name: 'descripcion_actividad_proyecto',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_lugar_actividad',
            type: 'auto'
        },
        {
            name: 'actividad_proyecto_tipo_actividad',
            type: 'auto'
        },
        {
            name: 'resultado_actividad',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        }
    ]
});