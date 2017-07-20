Ext.define('sisscsj.model.evaluaciones.Enfermeria', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_enfermeria',
    fields: [
        // id field
        {
            name: 'id_enfermeria',
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
            name: 'fk_id_vacuna',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_enfermeria',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'observaciones_enfermeria',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'nombre_vacuna',
            type: 'auto'
        }
    ]
});