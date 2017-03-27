package com.guideapp.guideapp.ui.adapters;

import android.content.Context;
import android.graphics.PorterDuff;
import android.graphics.drawable.LayerDrawable;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RatingBar;
import android.widget.TextView;

import com.guideapp.guideapp.R;
import com.guideapp.guideapp.model.Opinion;

import java.util.List;


public class WhatsHotAdapter
        extends RecyclerView.Adapter<WhatsHotAdapter.ViewHolder>
        implements View.OnClickListener {
    private List<Opinion> items;
    private OnItemClickListener onItemClickListener;
    private Context mContext;

    public WhatsHotAdapter(Context context, List<Opinion> items) {
        this.items = items;
        this.mContext = context;
    }

    public void setOnItemClickListener(OnItemClickListener onItemClickListener) {
        this.onItemClickListener = onItemClickListener;
    }

    @Override public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(
                R.layout.item_whatshot_opinion, parent, false);
        v.setOnClickListener(this);
        return new ViewHolder(v);
    }

    @Override public void onBindViewHolder(ViewHolder holder, int position) {
        Opinion item = items.get(position);

        holder.nameUserView.setText(item.getName());
        holder.ratingView.setRating(item.getRating());

        LayerDrawable stars = (LayerDrawable) holder.ratingView.getProgressDrawable();
        stars.getDrawable(2).setColorFilter(mContext.getResources().getColor(
                R.color.primary_star), PorterDuff.Mode.SRC_ATOP);
        stars.getDrawable(1).setColorFilter(mContext.getResources().getColor(
                R.color.secondary_star), PorterDuff.Mode.SRC_ATOP);
        stars.getDrawable(0).setColorFilter(mContext.getResources().getColor(
                R.color.secondary_star), PorterDuff.Mode.SRC_ATOP);

        holder.itemView.setTag(item);
    }

    @Override public int getItemCount() {
        return items.size();
    }

    @Override public void onClick(final View v) {
        onItemClickListener.onItemClick(v, (Opinion) v.getTag());
    }

    protected static class ViewHolder extends RecyclerView.ViewHolder {
        public TextView nameUserView;
        public TextView dateView;
        public TextView opinionView;
        public RatingBar ratingView;

        public ViewHolder(View itemView) {
            super(itemView);
            nameUserView = (TextView) itemView.findViewById(R.id.nameUser);
            dateView = (TextView) itemView.findViewById(R.id.date);
            opinionView = (TextView) itemView.findViewById(R.id.opinion);
            ratingView = (RatingBar) itemView.findViewById(R.id.ratingBar);

        }
    }

    public interface OnItemClickListener {
        void onItemClick(View view, Opinion opinion);
    }
}
