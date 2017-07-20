Ext.define('sisscsj.controller.familia.FamiliaMiembros', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'familia.FamiliaMiembros'
    ],
    views: [
        'familia.MiembrosLista',
        'familia.edit.FormMiembros',
        'familia.edit.WindowMiembros'
    ],
    refs: [
        {
            ref: 'FamiliaMiembrosLista',
            selector: '[xtype=familia.miembroslista]'
        },
        {
            ref: 'FamiliaMiembrosWindow',
            selector: '[xtype=familia.edit.windowmiembros]'
        },
        {
            ref: 'FamiliaMiembrosForm',
            selector: '[xtype=familia.edit.formmiembros]'
        },
        {
            ref: 'FamiliaLista',
            selector: '[xtype=familia.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=familia.miembroslista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    select: this.habilitarBotones,
                    delselect: this.deshabilitarBotones
                },
                'grid[xtype=familia.miembroslista] button#add': {
                    click: this.add
                },
                'grid[xtype=familia.miembroslista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=familia.miembroslista] button#delete': {
                    click: this.remove
                },
                'window[xtype=familia.edit.windowmiembros] button#save': {
                    click: this.save
                },
                'window[xtype=familia.edit.windowmiembros] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this;
        var store = grid.getStore();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        // clear any fliters that have been applied
        store.clearFilter(true);
        var contFamilia = me.getController('familia.Familia');
        
        if ( contFamilia.boolFamiliaEdit === 1)
        {
            var grid2 = me.getFamiliaLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_familia', data['id_familia'] );
            }
        }
        
        // Se deshabilita o habilita los botones de edit y delete
        // según se haya elegido un registro o no.
        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },

    
    habilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getFamiliaMiembrosLista();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if ( botonEdit.disabled || botonDelete.disabled )
        {
            botonEdit.enable();
            botonDelete.enable();
        }
    },


    deshabilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getFamiliaLista();
        var records = grid.getSelectionModel().getSelection();

        if (records.length > 0)
        {
            var grid2 = me.getFamiliaMiembrosLista();
            var botonEdit = grid2.down("[xtype='toolbar'] button#edit");
            var botonDelete = grid2.down("[xtype='toolbar'] button#delete");

            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this;

        var grid = me.getFamiliaMiembrosLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.familia.FamiliaMiembros');
        
        // [INICIO] Se recupera el ID de la familia
        var grid1 = me.getFamiliaLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        var contFamilia = me.getController('familia.Familia');

        // Beneficiario ya creado
        if ( recSeleccionados.length === 1 && contFamilia.boolFamiliaEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_familia', data1['id_familia']);

            me.showEditWindow(record);
        }
        else
        {
            // Beneficiario nuevo
            if ( contFamilia.boolFamiliaEdit === 0 )
            {
                me.showEditWindow(record);
            }
            else
            {
                console.log('[FamiliaMiembros] Error al recuperar el ID de la familia');
                return 'Error';
            }
        }
        // [FIN]
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getFamiliaMiembrosLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();

        // set values of record from form
        record.set(values);

        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }

        if ( form.isValid() )
        {
            // si es nuevo registro se lo añade al store, sino se lo actualiza
            var rowIndex = store.indexOf(record);
            ( rowIndex === -1 ) ? store.add(record) : form.updateRecord(record);

            win.close();
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;
        var grid = me.getFamiliaMiembrosLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contFamilia = me.getController('familia.Familia');

        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario nuevo. Solo se quita del store.
        if ( contFamilia.boolFamiliaEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario ya creado. Si es un registro recién creado (phantom == true)
        // solo se quita del store. Si no es un registro recién creado se lo quita del store
        // y de la base de datos (sync).
        else
        {
            if ( record.phantom )
            {
                store.remove(record);
            }
            else
            {
                Ext.Msg.confirm({
                    title: 'Atención',
                    msg: '¿Esta seguro que desea eliminar este Miembro de la Familia?. Esta acción no puede ser deshecha.',
                    icon: Ext.Msg.QUESTION,
                    buttonText: {
                        yes: 'Eliminar',
                        no: 'Cancelar'
                    },
                    fn: function(buttonId, text, opt) 
                    {
                        if (buttonId === 'yes') {
                            store.remove(record);
                        }
                    }
                });
            }
        }

        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getFamiliaMiembrosWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('familia.edit.windowmiembros', {
                title: isNew ? 'Añadir Miembro de la Familia' : 'Editar Miembro de la Familia'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
                grid = me.getFamiliaMiembrosLista(),
                store = grid.getStore();
        
        store.sync();
    }
});