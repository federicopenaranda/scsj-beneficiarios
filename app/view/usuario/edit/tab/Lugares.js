Ext.define('sisscsj.view.usuario.edit.tab.Lugares', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.edit.tab.lugares',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.Lugar',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
                
        var storeLugares = Ext.data.StoreManager.lookup('opciones.Lugar');
        storeLugares.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    //html: '<div id="featuresdiv"></div>'
                    xtype: 'itemselector',
                    id: 'usuario_lugar',
                    name: 'usuario_lugar',
                    anchor: '100%',
                    store: storeLugares,
                    displayField: 'nombre_lugar_actividad',
                    valueField: 'id_lugar_actividad',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Lugares Disponibles',
                    toTitle: 'Lugares Seleccionados',
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