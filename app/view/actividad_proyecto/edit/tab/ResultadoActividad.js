Ext.define('sisscsj.view.actividad_proyecto.edit.tab.ResultadoActividad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad_proyecto.edit.tab.resultadoactividad',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        //'sisscsj.store.opciones.Resultado',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
                
        var storeResultado = Ext.data.StoreManager.lookup('resultado.Resultado');
        storeResultado.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    //html: '<div id="featuresdiv"></div>'
                    xtype: 'itemselector',
                    itemId: 'resultado_actividad',
                    name: 'resultado_actividad',
                    anchor: '100%',
                    store: storeResultado,
                    displayField: 'descripcion_resultado',
                    valueField: 'id_resultado',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Resultados Disponibles',
                    toTitle: 'Resultados Seleccionados',
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