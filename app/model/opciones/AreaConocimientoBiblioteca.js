Ext.define('sisscsj.model.opciones.AreaConocimientoBiblioteca', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_area_conocimiento_biblioteca',
    fields: [
        {
            name: 'id_area_conocimiento_biblioteca',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_area_conocimiento_biblioteca',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_area_conocimiento_biblioteca',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_area_conocimiento_biblioteca',
            type: 'string',
            useNull: true
        }
    ]
});
