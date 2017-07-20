Ext.define('sisscsj.model.opciones.Idioma', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_idioma',
    fields: [
        {
            name: 'id_idioma',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_idioma',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_idioma',
            type: 'string',
            useNull: true
        }
    ]
});
