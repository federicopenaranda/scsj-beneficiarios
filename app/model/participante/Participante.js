/**
 * Modelo que representa un participante
 */
Ext.define('sisscsj.model.participante.Participante', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario',
    fields: [
        // id field
        {
            name: 'id_beneficiario',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_curso',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_nivel',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_turno',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'codigo_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'primer_nombre_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'segundo_nombre_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_paterno_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_materno_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_nacimiento_beneficiario',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d'
        },
        {
            name: 'sexo_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'numero_hijo_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fotografia_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'observacion_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'trabaja_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'carnet_de_salud_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'libreta_escolar_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'informacion_relevante_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'beneficiario_telefono',
            type: 'string',
            useNull: true
        },
        {
            name: 'beneficiario_estado_civil',
            type: 'string',
            useNull: true
        },
        {
            name: 'beneficiario_tipo_identificacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'beneficiario_ocupacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'beneficiario_trabajo',
            type: 'string',
            useNull: true
        },
        {
            name: 'registro_gestion_actual',
            type: 'auto'
        },
        {
            name: 'beneficiario_idioma',
            type: 'auto'
        },
        {
            name: 'beneficiario_donante',
            type: 'auto'
        },
        {
            name: 'beneficiario_unidad_educativa',
            type: 'auto'
        },
        {
            name: 'beneficiario_otros_programas',
            type: 'auto'
        },
        {
            name: 'beneficiario_actividad_favorita',
            type: 'auto'
        },
        {
            name: 'beneficiario_estado_beneficiario',
            type: 'auto'
        },
        {
            name: 'beneficiario_donante',
            type: 'auto'
        },
        {
            name: 'nombre_patrocinador_beneficiario_patrocinador',
            type: 'auto'
        },
        {
            name: 'numero_caso_beneficiario_patrocinador',
            type: 'auto'
        },
        {
            name: 'numero_ninio_beneficiario_patrocinador',
            type: 'auto'
        },
        {
            name: 'codigo_donante_beneficiario_patrocinador',
            type: 'auto'
        },
        {
            name: 'nombre_religion',
            type: 'auto'
        },
        {
            name: 'nombre_entidad_salud',
            type: 'auto'
        },
        {
            name: 'fotografia_beneficiario',
            type: 'auto'
        },
        {
            name: 'beneficiario_entidad',
            type: 'auto'
        }
    ]
});