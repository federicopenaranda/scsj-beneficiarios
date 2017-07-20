Ext.define('sisscsj.model.opciones.Curso', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_curso',
    fields: [
        {
            name: 'id_curso',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_curso',
            type: 'string',
            useNull: true
        }
    ]
});
