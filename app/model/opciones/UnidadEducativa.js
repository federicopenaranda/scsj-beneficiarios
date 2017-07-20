/**
 * Modelo que representa una actividad favorita
 */
Ext.define('sisscsj.model.opciones.UnidadEducativa', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_unidad_educativa',
    fields: [
        // id field
        {
            name: 'id_unidad_educativa',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'nombre_unidad_educativa',
            type: 'string',
            useNull: true
        },
        {
            name: 'telefono_unidad_educativa',
            type: 'string',
            useNull: true
        },
        {
            name: 'direccion_unidad_educativa',
            type: 'string',
            useNull: true
        }
    ]
});