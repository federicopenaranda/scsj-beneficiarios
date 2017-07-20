Ext.define('sisscsj.view.gestion.edit.GestionBeneficiarioWindow', {
    extend: 'Ext.window.Window',
    alias: 'widget.gestion.edit.gestionbeneficiariowindow',
    requires: [
        'sisscsj.view.gestion.GestionBeneficiarioLista'
    ],
    iconCls: 'icon_user',
    width: 800,
    height: 600,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'gestion.gestionbeneficiariolista',
                    title: 'Inscripción de Beneficiarios a Gestión',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.gestion.GestionBeneficiario', {
                        pageSize: 10
                    })
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            itemId: 'cancel',
                            text: 'Cancelar',
                            iconCls: 'icon_delete'
                        },
                        '->',
                        {
                            xtype: 'button',
                            itemId: 'save',
                            text: 'Guardar',
                            iconCls: 'icon_save'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});