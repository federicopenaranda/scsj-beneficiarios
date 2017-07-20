Ext.define('sisscsj.model.familia.FamiliaMiembros', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_familia',
    fields: [
        // id field
        {
            name: 'id_beneficiario_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_parentesco',
            type: 'int',
            useNull: true
        },
        {
            name: 'vive_casa_beneficiario_familia',
            type: 'int',
            convert: function (v, record) {
                return typeof v === 'boolean' ? (v === true ? 1 : 0) : v;
            }
        },
        {
            name: 'estado_beneficiario_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_creacion_beneficiario_familia',
            type: 'auto'
        },
        {
            name: 'codigo_beneficiario',
            type: 'auto'
        },
        {
            name: 'primer_nombre_beneficiario',
            type: 'auto'
        },
        {
            name: 'segundo_nombre_beneficiario',
            type: 'auto'
        },
        {
            name: 'apellido_paterno_beneficiario',
            type: 'auto'
        },
        {
            name: 'apellido_materno_beneficiario',
            type: 'auto'
        },
        {
            name: 'nombre_completo_beneficiario',
            type: 'string',
            convert: function (newValue, model) {
                return model.get('primer_nombre_beneficiario') + ' ' + 
                        model.get('segundo_nombre_beneficiario') + ' ' + 
                        model.get('apellido_paterno_beneficiario') + ' ' + 
                        model.get('apellido_materno_beneficiario') + ' (' +
                        model.get('codigo_beneficiario') + ')' ;
            }
        }
    ]
});