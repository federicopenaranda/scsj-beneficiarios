Ext.define('sisscsj.view.actividad.edit.tab.SubArea', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad.edit.tab.subarea',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.SubAreaActividad',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
                
        var storeSubArea = Ext.data.StoreManager.lookup('opciones.SubAreaActividad');
        storeSubArea.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    //html: '<div id="featuresdiv"></div>'
                    xtype: 'itemselector',
                    itemId: 'actividad_area_actividad',
                    name: 'actividad_area_actividad',
                    anchor: '100%',
                    store: storeSubArea,
                    displayField: 'nombre_sub_area',
                    valueField: 'id_sub_area',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Sub-Áreas Disponibles',
                    toTitle: 'Sub-Áreas Seleccionados',
                    buttons: [ 'add', 'remove' ],
                    delimiter: null,
                    overflowY: 'scroll',
                    height: 350
                }
            ]
        });
        me.callParent(arguments);
    }
});