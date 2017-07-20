Ext.define('sisscsj.model.opciones.OtrosProgramas', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_otros_programas',
    fields: [
        {
            name: 'id_otros_programas',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_otros_programas',
            type: 'string',
            useNull: true
        },
        {
            name: 'sigla_otros_programas',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_otros_programas',
            type: 'string',
            useNull: true
        }
    ]
});
