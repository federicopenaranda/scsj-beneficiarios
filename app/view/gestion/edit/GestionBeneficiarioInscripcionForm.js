Ext.define('sisscsj.view.gestion.edit.GestionBeneficiarioInscripcionForm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.gestion.edit.gestionbeneficiarioinscripcionform',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_beneficiario',
                            id: 'fk_id_beneficiario',
                            fieldLabel: 'Miembro:',
                            displayTpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario} ({codigo_beneficiario})',
                                        '</tpl>'),
                            tpl: '<tpl for="."><div class="x-boundlist-item" >{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario} ({codigo_beneficiario})</div></tpl>',
                            valueField: 'id_beneficiario',
                            store: {
                                type: 'beneficiario.beneficiario'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: true,
                            forceSelection: true,
                            allowBlank: false,
                            typeAhead: true,
                            triggerAction: 'all',
                            minChars : 1,
                            totalProperty : 'total',
                            pageSize : 10,
                            listeners: {
                                beforequery: function( queryPlan, eOpts ) {
                                    var nQuery = [];
                                    var tmpQuery = {
                                        primer_nombre_beneficiario: queryPlan.query,
                                        segundo_nombre_beneficiario: queryPlan.query,
                                        apellido_paterno_beneficiario: queryPlan.query,
                                        apellido_materno_beneficiario: queryPlan.query
                                    };
                                    nQuery.push(tmpQuery); // push this to the array
                                    queryPlan.query = Ext.encode(nQuery);
                                }
                            }
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});