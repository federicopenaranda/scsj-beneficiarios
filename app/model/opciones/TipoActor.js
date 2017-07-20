Ext.define('sisscsj.model.opciones.TipoActor', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_actor_beneficiario',
    fields: [
        {
            name: 'id_tipo_actor_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_actor_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_actor_beneficiario',
            type: 'string',
            useNull: true
        }
    ]
});
