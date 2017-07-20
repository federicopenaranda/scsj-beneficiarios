Ext.define('sisscsj.view.beneficiario.edit.tab.Donante', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.donante',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.Donante',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
                
        var storeDonante = Ext.data.StoreManager.lookup('opciones.Donante');
        storeDonante.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    //html: '<div id="featuresdiv"></div>'
                    xtype: 'itemselector',
                    itemId: 'beneficiario_donante',
                    name: 'beneficiario_donante',
                    anchor: '100%',
                    store: storeDonante,
                    displayField: 'nombre_donante',
                    valueField: 'id_donante',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Donantes Disponibles',
                    toTitle: 'Donantes Seleccionados',
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