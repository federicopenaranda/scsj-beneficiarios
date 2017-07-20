Ext.define('sisscsj.model.opciones.Departamento', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_departamento',
    fields: [
        {
            name: 'id_departamento',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_departamento',
            type: 'string',
            useNull: true
        }
    ]
});
