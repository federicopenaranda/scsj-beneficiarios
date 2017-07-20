Ext.define('sisscsj.model.evaluaciones.Computacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_eval_computacion',
    fields: [
        // id field
        {
            name: 'id_eval_computacion',
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
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'tipo_eval_computacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_eval_computacion',
            type: 'date',
            useNull: true
        },
        {
            name: 'evaluacion_computacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_eval_computacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'codigo_beneficiario',
            type: 'auto'
        }
    ]
});