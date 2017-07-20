Ext.define('sisscsj.model.evaluaciones.Pedagogia', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_pedagogico',
    fields: [
        // id field
        {
            name: 'id_pedagogico',
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
            name: 'fecha_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'matematicas_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'lenguaje_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'desarrollo_habilidades_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'ciencias_vida_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'idiomas_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'tecnologia_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_pedagogico',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_beneficiario',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        }
    ]
});