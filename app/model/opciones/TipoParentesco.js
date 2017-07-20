Ext.define('sisscsj.model.opciones.TipoParentesco', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_parentesco',
    fields: [
        {
            name: 'id_tipo_parentesco',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_parentesco',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_parentesco',
            type: 'string',
            useNull: true
        }
    ]
});
