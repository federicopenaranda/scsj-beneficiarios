Ext.define('sisscsj.model.evaluaciones.Biblioteca', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_biblioteca',
    fields: [
        // id field
        {
            name: 'id_biblioteca',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_area_cononcimiento_biblioteca',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_nivel',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_curso',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_turno',
            type: 'int',
            useNull: true
        },
        // Campos simples
        {
            name: 'tipo_usuario_biblioteca',
            type: 'string',
            useNull: true
        },
        {
            name: 'sexo_usuario_biblioteca',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_consulta_biblioteca',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'observaciones_biblioteca',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'nombre_area_conocimiento_biblioteca',
            type: 'auto'
        },
        {
            name: 'nombre_nivel',
            type: 'auto'
        },
        {
            name: 'nombre_curso',
            type: 'auto'
        },
        {
            name: 'nombre_turno',
            type: 'auto'
        }
    ]
});