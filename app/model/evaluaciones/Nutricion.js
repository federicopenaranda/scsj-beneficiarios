Ext.define('sisscsj.model.evaluaciones.Nutricion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_nutricion',
    fields: [
        // id field
        {
            name: 'id_nutricion',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_tipo_consulta',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_nutricion',
            type: 'string'
        },
        {
            name: 'peso_talla_nutricion',
            type: 'string',
            useNull: true
        },
        {
            name: 'talla_edad_nutricion',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_nutricion',
            type: 'string',
            useNull: true
        },
        {
            name: 'peso_nutricion',
            type: 'float',
            useNull: true
        },
        {
            name: 'talla_nutricion',
            type: 'float',
            useNull: true
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        }
    ]
});