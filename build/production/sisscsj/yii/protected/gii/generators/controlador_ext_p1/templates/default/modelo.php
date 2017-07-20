<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 * - <?php echo $tableName; ?>
 * - <?php echo $modelClass; ?>
 *<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => '$label',\n"; ?>
<?php endforeach; ?>
 
 */
?>
<?php echo print_r($labels);?>
<?php 
$contPrimaryKey=0;
foreach($columns as $column):
if($column->isPrimaryKey==1)
	$contPrimaryKey++; 
endforeach; 
?>
<?php $path=str_replace("C:/xampp/htdocs/","",Yii::getPathOfAlias('webroot'));?>
<?php if(sizeof($labels)<=3): ?>
Ext.define('<?php echo $path;?>.controller.opciones.<?php echo $modelClass; ?>',{
   extend:'<?php echo $path;?>.controller.Base',
   stores: [
   	   'opciones.<?php echo $modelClass; ?>'
   ],
   views: [
	   '<?php echo strtolower($modelClass); ?>.Lista'
   ],
   refs: [
	{
	  ref: '<?php echo $modelClass; ?>Lista',
          selector:'[xtype=<?php echo strtolower($modelClass); ?>.lista]'
	}
   ],
	init:function(){
	  this.listen({
	   	 controller:{},
	   	 component:{
		'grid[xtype=<?php echo strtolower($modelClass); ?>.lista]': {
                    edit: this.save,
                    canceledit: this.cancel,
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=<?php echo strtolower($modelClass); ?>.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=<?php echo strtolower($modelClass); ?>.lista] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=<?php echo strtolower($modelClass); ?>.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=<?php echo strtolower($modelClass); ?>.lista] gridview': {
                    itemadd: this.edit
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.get<?php echo $modelClass; ?>Lista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this,
                grid = me.get<?php echo $modelClass; ?>Lista(),
                plugin = grid.editingPlugin;
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.get<?php echo $modelClass; ?>Lista(),
                plugin = grid.editingPlugin,
                record = grid.getSelectionModel().getSelection()[0];

        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
                grid = me.get<?php echo $modelClass; ?>Lista(),
                plugin = grid.editingPlugin,
                store = grid.getStore();

        if (plugin.editing) {
            Ext.Msg.alert('Atención', 'Por favor termine de editar antes de ingresar un nuevo registro.');
            return false;
        }
                
        store.insert(0, {});
    },


    save: function(editor, context, eOpts) {
        var me = this,
                store = context.record.store;
        store.save();
    },


    remove: function(record) {
        var me = this;

        var grid = me.get<?php echo $modelClass; ?>Lista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta <?php echo $modelClass; ?>?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                    store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    })
                }
            }
        });
    }
});
<?php endif;?>






   
