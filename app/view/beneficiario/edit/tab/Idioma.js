Ext.define('sisscsj.view.beneficiario.edit.tab.Idioma', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.idioma',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.Idioma',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
                
        var storeIdioma = Ext.data.StoreManager.lookup('opciones.Idioma');
        storeIdioma.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'beneficiario_idioma',
                    name: 'beneficiario_idioma',
                    anchor: '100%',
                    store: storeIdioma,
                    displayField: 'nombre_idioma',
                    valueField: 'id_idioma',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Idiomas Disponibles',
                    toTitle: 'Idiomas Seleccionados',
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