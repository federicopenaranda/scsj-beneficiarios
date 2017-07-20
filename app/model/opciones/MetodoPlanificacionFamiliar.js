Ext.define('sisscsj.model.opciones.MetodoPlanificacionFamiliar', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_metodo_planificacion_familiar',
    fields: [
        {
            name: 'id_metodo_planificacion_familiar',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_metodo_planificacion_familiar',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_metodo_planificacion_familiar',
            type: 'string',
            useNull: true
        }
    ]
});
