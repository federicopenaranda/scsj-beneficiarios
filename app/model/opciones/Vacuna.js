Ext.define('sisscsj.model.opciones.Vacuna', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_vacuna',
    fields: [
        {
            name: 'id_vacuna',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_vacuna',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_vacuna',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_vacuna',
            type: 'string',
            useNull: true
        }
    ]
});
