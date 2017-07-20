Ext.define('sisscsj.model.familia.FamiliaServicioBasico', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_familia_servicio_basico',
    fields: [
        {
            name: 'id_familia_servicio_basico',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_servicio_basico',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'observacion_familia_servicio_basico',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_familia_servicio_basico',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_servicio_basico',
            type: 'auto'
        }
        
    ]
});