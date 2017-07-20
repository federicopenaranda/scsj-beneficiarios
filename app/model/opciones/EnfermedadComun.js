Ext.define('sisscsj.model.opciones.EnfermedadComun', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_enfermedad_comun',
    fields: [
        {
            name: 'id_enfermedad_comun',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_enfermedad_comun',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_enfermedad_comun',
            type: 'string',
            useNull: true
        }
    ]
});
