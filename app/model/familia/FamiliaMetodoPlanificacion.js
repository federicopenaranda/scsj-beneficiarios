Ext.define('sisscsj.model.familia.FamiliaMetodoPlanificacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_familia_metodo_planificacion',
    fields: [
        // id field
        {
            name: 'id_familia_metodo_planificacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_metodo_planificacion_familiar',
            type: 'int',
            useNull: true
        }
    ]
});