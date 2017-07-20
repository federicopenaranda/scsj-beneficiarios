Ext.define('sisscsj.model.actividad_proyecto.ActividadTipoParticipante', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_actividad_tipo_participante',
    fields: [
        // id field
        {
            name: 'id_actividad_tipo_participante',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_actividad_proyecto',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_edades_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'cantidad_actividad_tipo_participante',
            type: 'int',
            useNull: true
        },
        {
            name: 'sexo_actividad_tipo_participante',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_edades_beneficiario',
            type: 'auto'
        }
    ]
});