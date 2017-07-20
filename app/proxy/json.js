/**
 * Abstract JSON proxy 
 */
Ext.define('sisscsj.proxy.JSON', {
    extend: 'Ext.data.proxy.JsonP',
    alias: 'proxy.basejson',
    format: 'json',
    //limitParam: 'max',
    //startParam: 'offset',
    //sortParam: 'sortorder',
    writer: {
        type: 'json',
        writeAllFields: true,
        dateFormat: 'Y-m-d'
    },

    reader: {
        type: 'json',
        root: 'registros',
        totalProperty: 'total'
    },

    afterRequest: function(request, success) {
        var me = this;
        // fire requestcomplete event
        me.fireEvent('requestcomplete', request, success);
    }
});