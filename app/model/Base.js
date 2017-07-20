/**
 * Base {@link Ext.data.Model} from which all other models will extend
 */
Ext.define('sisscsj.model.Base', {
    extend: 'Ext.data.Model',
    fields: [
        // campos en comun de los modelos derivados de este
        /*{
            name: 'CreatedDate',
            type: 'date',
            persist: false
        },
        {
            name: 'Active',
            type: 'boolean',
            defaultValue: true
        }*/
    ]
});