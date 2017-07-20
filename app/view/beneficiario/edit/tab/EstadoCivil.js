/**
 * Main panel for displaying images for {@link CarTracker.model.Car} records
 */
Ext.define('sisscsj.view.beneficiario.edit.tab.EstadoCivil', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.estadocivil',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listaestadocivil',
                    title: 'Administración de Estado Civil',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioEstadoCivil', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});