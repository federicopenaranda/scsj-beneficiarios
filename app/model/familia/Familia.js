Ext.define('sisscsj.model.familia.Familia', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_familia',
    fields: [
        // id field
        {
            name: 'id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'codigo_familia',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_familia_antiguo',
            type: 'string',
            useNull: true
        },
        {
            name: 'numero_hijos_viven_familia',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'familia_servicio_basico',
            type: 'string',
            useNull: true
        },
        {
            name: 'familia_tipo_casa',
            type: 'string',
            useNull: true
        },
        {
            name: 'familia_metodo_planificacion_familiar',
            type: 'auto'
        },
        {
            name: 'evento_vital_familia',
            type: 'auto'
        },
        {
            name: 'familia_direccion',
            type: 'auto'
        },
        {
            name: 'beneficiario_familia',
            type: 'auto'
        },
        // Campos para búsqueda
        {
            name: 'apellido_paterno_beneficiario',
            type: 'auto'
        },
        {
            name: 'apellido_materno_beneficiario',
            type: 'auto'
        },
        {
            name: 'primer_nombre_beneficiario',
            type: 'auto'
        },
        {
            name: 'segundo_nombre_beneficiario',
            type: 'auto'
        }
    ]
});