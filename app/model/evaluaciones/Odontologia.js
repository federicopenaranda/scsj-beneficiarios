Ext.define('sisscsj.model.evaluaciones.Odontologia', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_odontologia',
    fields: [
        // id field
        {
            name: 'id_odontologia',
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
            name: 'fecha_odontologia',
            type: 'string',
            useNull: true
        },
        {
            name: 'cpitn_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'higiene_odontologia',
            type: 'string',
            useNull: true
        },
        {
            name: 'indice_may_c_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'indice_may_p_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'indice_may_d_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'indice_may_o_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'indice_min_c_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'indice_min_e_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'indice_min_o_odontologia',
            type: 'float',
            useNull: true
        },
        {
            name: 'observaciones_odontologia',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_beneficiario',
            type: 'auto',
            persist: false
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'auto',
            persist: false
        },
        {
            name: 'nombre_usuario',
            type: 'auto',
            persist: false
        }
    ]
});